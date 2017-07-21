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
          console.log('Error', e.response.status);
          console.log(e.response.data.message);
        } else {
          console.log('Error', e.message);
        }
      });
  }

  remove(pageId, onSuccess, onError) {  // eslint-disable-line
    axios.delete(`${this.restRootUrl}/${pageId}`).then(onSuccess).catch((e) => {
      onError.call(null, e);
      if (e.response) {
        console.log('Error', e.response.status);
        console.log(e.response.data.message);
      } else {
        console.log('Error', e.message);
      }
    });
  }

  post(newPage, onSuccess, onError) {
    axios.post(this.restRootUrl, newPage).then(onSuccess).catch((e) => {
      onError.call(null, e);
      if (e.response) {
        console.log('Error', e.response.status);
        console.log(e.response.data.message);
      } else {
        console.log('Error', e.message);
      }
    });
  }
}