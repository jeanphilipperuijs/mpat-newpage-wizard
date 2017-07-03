
let raw = document.getElementById('raw');
raw.style.fontSize = '0.8em';
raw.style.fontFamily = 'monospace';

const format = (txt) => {
    return JSON.stringify(JSON.parse(txt), null, 6);
};

const loadPages = () => {
    const req = new XMLHttpRequest();
    req.onreadystatechange = function (event) {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                let txt = this.responseText;
                raw.innerText = format(txt);
                console.log(JSON.parse(txt));
            } else {
                console.log(this.status, this.statusText);
            }
        }
    };
    let url = `${wpApiSettings.root}${wpApiSettings.versionString}pages/?per_page=100`;
    console.log(url);
    req.open('GET', url, true);
    req.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
    req.send(null);
};

const loadLayouts = () => {
    const req = new XMLHttpRequest();
    req.onreadystatechange = function (event) {
        if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
                let txt = this.responseText;
                raw.innerText = format(txt);
                console.log(JSON.parse(txt));
            } else {
                console.log(this.status, this.statusText);
            }
        }
    };
    let url = `${wpApiSettings.root}mpat/v1/layout/?per_page=100`;
    console.log(url);
    req.open('GET', url, true);
    req.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
    req.send(null);
};