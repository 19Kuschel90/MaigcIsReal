<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Show a Moster</div>

                    <div class="card-body">
                        <div>
                          <div>Name:<input v-model="Moster['name']"></div>
                          <div>imgName:<input v-model="Moster['imgName']"></div>
                          <div>AP:<input v-model="Moster['AP']"></div>
                          <div>DP:<input v-model="Moster['DP']"></div>
                          <div>Speed:<input v-model="Moster['Speed']"></div>
                          <div>SpwanWert:<input v-model="Moster['SpwanWert']"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted ShowAMoster.')
        },
        created(){
                this.send('post','/getAMoster' );
        },
         data() {
            return {
                Moster:{
                    name: '',
                    imgName: '',
                    AP: -1,
                    DP: -1,
                    Speed: -1,
                    SpwanWert: -1,
                },
        
            };
        },
        methods:{
             send(methode, url, data = null, toDoFUN = ()=>{}){
                    var token = document.head.querySelector('meta[name="csrf-token"]');
                        console.log('token.content',token.content);
                        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                            axios({
                        method: methode,
                        //   method: 'post',
                        url: url,
                        //   url: '/hello',
                        data:data,
                        
                        validateStatus: (status) => {
                            return true; // I'm always returning true, you may want to do it depending on the status received
                        },
                        }).catch(error => {
                            console.log('error', error);
                        }).then(response => {
                            // this is now called!
                                                    debugger;
                            this.userData["id"] = response.data.id;
                            this.userData["name"] = response.data.name;
                            this.userData["email"] = response.data.email;
                            console.log('response', response);

                        });
                            toDoFUN();
              }
            }    
        }
</script>
