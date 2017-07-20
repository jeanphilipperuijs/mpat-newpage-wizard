import axios from 'axios';

export default class CRUD {
  constructor(restRootUrl) {
    this.restRootUrl = restRootUrl;
    axios.defaults.headers.common['X-WP-Nonce'] = window.wpApiSettings.nonce;
  }

  get(onSuccess, onError) {
    axios.get(this.restRootUrl, {})
        .then((v) => { onSuccess.call(null, v.data); })
        .catch((e) => {
          onError.call(null, e);
          if (e.response) {
            // The request was made, but the server responded with a status code
            // that falls out of the range of 2xx
            console.log('Error', e.response.status);
            console.log(e.response.data.message);
          } else {
            // Something happened in setting up the request that triggered an
            // Error
            console.log('Error', e.message);
          }
        });
  }

  remove(pageId, onSuccess, onError) {  // eslint-disable-line
    axios.delete(`${this.restRootUrl}/${pageId}`).then(onSuccess).catch((e) => {
      onError.call(null, e);
      if (e.response) {
        // The request was made, but the server responded with a status code
        // that falls out of the range of 2xx
        console.log('Error', e.response.status);
        console.log(e.response.data.message);
      } else {
        // Something happened in setting up the request that triggered an Error
        console.log('Error', e.message);
      }
    });
  }

  post(newPage, onSuccess, onError) {  // eslint-disable-line
    axios.post(this.restRootUrl, newPage).then(onSuccess).catch((e) => {
      onError.call(null, e);
      if (e.response) {
        // The request was made, but the server responded with a status code
        // that falls out of the range of 2xx
        console.log('Error', e.response.status);
        console.log(e.response.data.message);
      } else {
        // Something happened in setting up the request that triggered an Error
        console.log('Error', e.message);
      }
    });
  }
}