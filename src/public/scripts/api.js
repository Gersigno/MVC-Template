/**
 * Fetches JSON data from the target API and renders it inside a given container element.
 * @param {string} endpoint - Target API endpoint to fetch data from (/API for our project).
 * @param {string} resultContainerId - HTML element's ID to inject our result.
 * @returns {Promise<void>}
 */
async function fetchAndRender(endpoint, resultContainerId) {
    try {
        const response = await fetch(endpoint);
        if (!response.ok) {
            console.error(`Failed to fetch ${endpoint}`);
            return;
        }

        const data = await response.json();
        console.log(data);

        const container = document.getElementById(resultContainerId);
        if (!container) return;

        container.innerHTML = '';
        renderObject(data, container);
    } catch (error) {
        console.error(`Error fetching ${endpoint}:`, error);
    }
}

/**
 * Renders object's properties in the targeted container.
 * @param {Object} obj - The object to render.
 * @param {HTMLElement} container - Target HTML element to append results to.
 */
function renderObject(obj, container) {
    Object.entries(obj).forEach(([key, value]) => {
        const code = document.createElement("code");
        if (typeof value === 'object' && value !== null) {
            code.innerHTML = `${key}:`;
            container.appendChild(code);
            renderObject(value, container, '↳ ');
        } else {
            code.innerHTML = `${key}: ${value}`;
            container.appendChild(code);
        }
    });
}

async function getExempleData() {
    await fetchAndRender("/API/exempleData", "fetch_ex_result");
}

async function getExempleModelTemplate() {
    await fetchAndRender("/API/exempleModelTemplate", "fetch_ex2_result");
}
