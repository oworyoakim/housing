
export function deepClone(object: any) {
    return JSON.parse(JSON.stringify(object));
}

export function prepareQueryParams(payload: any) {
    let params = [];
    for (let filter in payload) {
        if (filter !== 'setsLoader' && !!payload[filter]) {
            params.push(`${filter}=${payload[filter]}`);
        }
    }
    let queryParams = '';
    if (params.length > 0) {
        queryParams = '?' + params.join('&');
    }
    return queryParams;
}

export function resolveError(error: any) {
    if(!!error.response){
        console.error(error.response);
        if (error.response && error.response.status === 401) {
            if(location.pathname !== '/login'){
                location.href = '/login';
            }
        }
        return error.response.data;
    }
    console.error(error);
    return error.message;
}

export function createFormDataFromPayload(payload: any){
    let formData = new FormData();
    for (let field in payload) {
        if(payload[field]){
            formData.append(field, payload[field]);
        }
    }
    return formData;
}
