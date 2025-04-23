let controller = null;

const unloadHandler = () => {
    if (controller) {
        controller.abort();
        console.log("Fetch aborted on unload");
    }
};
window.addEventListener("unload", unloadHandler);

const makeHttpRequest = (method = "get", url, params = {}, csrfToken = "") => {
    return new Promise((resolve, reject) => {
        method = method.toLowerCase();
        if (!["get", "post"].includes(method)) {
            return reject(new Error("Method chỉ hỗ trợ GET hoặc POST"));
        }

        // create new AbortController for this request
        controller = new AbortController();
        const { signal } = controller;

        showLoading();

        const fetchOptions = {
            method: method.toUpperCase(),
            redirect: "manual",
            credentials: "include", // include cookies in request
            signal,
        };

        let fetchUrl = url;

        if (method === "post") {
            // handle file upload vs JSON
            if (params.file instanceof File || params.file instanceof Blob) {
                const formData = new FormData();
                Object.keys(params).forEach((key) =>
                    formData.append(key, params[key])
                );
                formData.append("_token", csrfToken);
                fetchOptions.body = formData;
            } else {
                const body = { ...params, _token: csrfToken };
                fetchOptions.headers = { "Content-Type": "application/json" };
                fetchOptions.body = JSON.stringify(body);
            }
        } else if (Object.keys(params).length) {
            const qp = new URLSearchParams(params).toString();
            fetchUrl = `${url}?${qp}`;
        }

        fetch(fetchUrl, fetchOptions)
            .then(async (response) => {
                if (
                    response.type === "opaqueredirect" ||
                    response.status === 302
                ) {
                    hideLoading();
                    alertErr("Không có quyền truy cập!");
                    throw {
                        status: response.status,
                        message: "Không có quyền truy cập!",
                    };
                }
                if (response.status >= 500) {
                    throw {
                        status: response.status,
                        message: response.statusText,
                    };
                }

                const contentType = response.headers.get("content-type") || "";
                let data;
                if (contentType.includes("application/json")) {
                    data = await response.json();
                } else {
                    data = await response.text();
                }

                if (!response.ok) {
                    var msg = data.message || data;
                    if (data.errors)
                        msg = Object.values(data.errors)
                            .flat()
                            .join(" - ");
                    alertErr(msg);
                    throw { status: response.status, data };
                }

                return data;
            })
            .then((data) => {
                // if refresh_token present in payload, set JS cookie
                if (data.refresh_token) {
                    const rt = data.refresh_token;
                    const maxAge = data.refresh_token_expires_in; // seconds
                    document.cookie = `refresh_token=${rt}; max-age=${maxAge}; path=/;`;
                }
                hideLoading();
                resolve(data);
            })
            .catch((err) => {
                hideLoading();
                if (err.name === "AbortError") {
                    console.warn("Request aborted");
                    return;
                }
                console.error("Fetch error:", err);
                reject(err);
            });
    });
};
