class HttpIntant {
    baseUrl = "/api";
    constructor(baseUrl) {
        this.baseUrl = baseUrl || this.baseUrl;
    }

    convertUrl(url) {
        if (url.startsWith("/")) {
            url = url.substring(1);
        }
        return url;
    }

    loading() {
        $("body").append(
            `<div class="loader-wrapper"><div class="loader"><span></span><span></span><span></span><span></span><span></span></div></div>`
        );
        $(".loader-wrapper").fadeOut("slow", function () {
            $(this).remove();
        });
    }

    async httpRequest(method = "GET", url, data, config = {}) {
        if (config.loading) this.loading();
        const isFormData = data instanceof FormData;
        return $.ajax({
            url: `${this.baseUrl}/${this.convertUrl(url)}`,
            xhrFields: {
                withCredentials: true,
            },
            processData: !isFormData, // không xử lý FormData
            contentType: isFormData ? false : "application/json",
            method,
            data: data,
            dataType: "json",
            headers: {
                Authorization: `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3NDUzNzkzMTEsImV4cCI6MTc0NjU4ODkxMSwibmJmIjoxNzQ1Mzc5MzExLCJqdGkiOiJ5eEF2N20ydTBRcGtYZUl2Iiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjciLCJyZWZyZXNoIjp0cnVlfQ.WbP9ITrDOhtiGZXBpPRQzyzSijk9k24TvFxDusNSKhM`,
                ...(config.headers || {}), // merge headers từ config
            },
            ...config,
        });
    }

    async get(url, data, config) {
        return this.httpRequest("GET", url, data, config);
    }
    async post(url, data, config) {
        return this.httpRequest("POST", url, data, config);
    }
    async put(url, data, config) {
        return this.httpRequest("PUT", url, data, config);
    }
    async delete(url, data, config) {
        return this.httpRequest("DELETE", url, data, config);
    }
    async patch(url, data, config) {
        return this.httpRequest("PATCH", url, data, config);
    }
}

const http = new HttpIntant();
