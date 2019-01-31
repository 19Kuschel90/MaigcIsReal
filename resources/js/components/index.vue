<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nix Mon</div>

                    <div class="card-body">
                      hallo welt
                    </div>
                </div>
               <div v-for="value in monsters">
                <component :is="showAMonster" :monster="value" :stopRun='stopRun'></component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CshowAMonster from './monster/showAMonster.vue';
    export default {
        mounted() {
            console.log('Component mounted.');

        },
         data() {
            return {
                updataTime: 3000,
             showAMonster: CshowAMonster,
                monsters: [],
                stopRun:true

            }

        },
        created(){
              this.send('post','/getLastMonster' );
              this.updata();
          },
    methods:{
        send(methode, url, data = null, toDoFUN = ()=>{}){
            try {
                        //  debugger;
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
                                console.log('response', response);
                                this.monsters = response.data.reverse();

                            });
                                toDoFUN();
                                } catch (error) {
                                    console.error('Send Error: ', error);
                            }
                },
                 updata(){
            this.intervalid1 = setInterval(()=>{
              this.send('post','/getLastMonster' );
             }, this.updataTime);
        },

    }
}
</script>
