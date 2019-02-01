<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <div>
                          <div>Name:<input v-model="monster['name']"></div>
                          <div>imgName:<input v-model="monster['imgName']"></div>
                          <div>AP:<input v-model="monster['AP']"></div>
                          <div>DP:<input v-model="monster['DP']"></div>
                          <div>HP:<input v-model="monster['HP']"></div>
                          <div>Speed:<input v-model="monster['Speed']"></div>
                          <div>SpwanWert:<input v-model="monster['SpwanWert']"></div>
                        </div>
                        <button v-on:click="create">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {CMonster} from './CMonster.js';

    export default {
        mounted() {
            console.log('Component mounted.');
        },
         data() {
            return {
             monster: new CMonster(),
            };
        },
          methods:{
              create(){
                  this.send('post','/createAMonster', this.monster );
              },

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

                            // this.monster["id"] = response.data.id;
                            // this.monster["name"] = response.data.name;
                            // this.monster["imgName"] = response.data.imgName;
                            // this.monster["AP"] = response.data.AP;
                            // this.monster["DP"] = response.data.DP;
                            // this.monster["Speed"] = response.data.Speed;
                            // this.monster["SpwanWert"] = response.data.SpwanWert;

                        });
                            toDoFUN();
                            } catch (error) {
                                console.error('Send Error: ', error);
                        }
              },
          }
    }
</script>
