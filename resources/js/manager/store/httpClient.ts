let baseUrl = null, csrfToken = null;
let baseUrlElement: any = document.head.querySelector('meta[name="base-url"]');
let csrfTokenElement: any = document.head.querySelector('meta[name="csrf-token"]');

if (baseUrlElement) {
    baseUrl = baseUrlElement.content || null;
}
if (csrfTokenElement) {
    csrfToken = csrfTokenElement.content || null;
}
// Configure Axios for HTTP Requests
const axios = require('axios');

export default axios.create({
    baseURL: baseUrl, // Register the Application base URL
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'CSRF-TOKEN': csrfToken,
    },
});
