export function send(methode, url, data = null, callback = () => {}) {
    try {
        //  debugger;
        var token = document.head.querySelector('meta[name="csrf-token"]');
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        axios({
            method: methode,
            //   method: 'post',
            url: url,
            //   url: '/hello',
            data: data,

            validateStatus: (status) => {
                return true; // I'm always returning true, you may want to do it depending on the status received
            },
        }).catch(error => {
            console.error(url, ' error', error);
        }).then(response => {
            // this is now called!
            console.log(url, ' response', response);

            callback(response);
        });
    } catch (error) {
        console.error('Send Error: ', error);
    }
}