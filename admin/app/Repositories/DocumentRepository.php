<?php

namespace App\Repositories;

use App\Models\Document;

class DocumentRepository
{
    public function findById(int $id)
    {
        return Document::find($id)->load([
            'type',
            'uploader',
            'share',
            'legal.type',
            'scientificPublication.type',
            'biodiversity.type',
        ]);
    }
    public function list(array $request)
    {
        $query = Document::orderByDesc("id")->with([
            'type',
            'uploader',
            'share',
            'legal',
            'scientificPublication',
            'biodiversity',
        ]);
        // lọc theo cho phép tải
        if ($request["allow_download"] != null)
            $query->where("allow_download", $request["allow_download"]);

        // lọc xem các văn bản được chia sẻ và đã được duyệt
        if ($request["is_shared"] == 1)
            $query->whereNotNull("id_share")->whereHas("share", function ($q) {
                $q->where("status", "approve");
            });

        // lọc xem các văn bản không phải được chia sẻ
        if ($request["is_shared"] == 0)
            $query->whereNull("id_share");

        // lọc theo loại văn bản
        if (!empty($request["id_document_type"]))
            $query->where("id_document_type", $request["id_document_type"]);

        // lọc theo người đăng tải
        if (!empty($request["id_uploader"]))
            $query->where("id_uploader", $request["id_uploader"]);

        // lọc theo đơn vị của người đăng tải hoặc người chia sẻ
        if (!empty($request["id_unit"]))
            $query->whereHas("uploader.unit", function ($q) use ($request) {
                $q->where("id_unit",  $request["id_unit"]);
            })->orWhereHas("share.unit", function ($q) use ($request) {
                $q->where("id_unit",  $request["id_unit"]);
            });

        // lọc theo năm ban hành
        if (!empty($request["issued_year"]))
            $query->whereYear("issued_date", $request["issued_year"]);

        // tìm kiếm theo tên tài liệu hoặc tác giả
        if (!empty($request["search"]))
            $query->where("name", "ilike", "%" . $request["search"] . "%")->orWhere("author", "ilike", "%" . $request["search"] . "%");

        $records = $query->get()->toArray();
        return $records;
    }

    public function store(array $request)
    {
        return Document::create($request);
    }

    public function update(array $request, bool $removeOld)
    {
        $record = Document::find($request["id"]);

        if ($removeOld == true)
            if (file_exists(public_path($record->path)))
                unlink(public_path($record->path));

        $record->update($request);
        return $record;
    }

    public function delete(array $request)
    {
        return Document::find($request["id"])->delete();
    }

    public function getIssuedYears()
    {
        return Document::pluck('issued_date')
            ->map(fn($date) => date('Y', strtotime($date)))
            ->unique()
            ->sortDesc()
            ->values()
            ->toArray();
    }
}
