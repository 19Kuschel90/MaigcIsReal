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
import {send} from './../axiosSend.js';

    export default {
        mounted() {
            console.log('Component mounted.');
        },
         data() {
            return {
             monster: new CMonster(),
             login: 0,
            };
        },
          methods:{
              create(){

                        send('post','/iMLogin ',  null, (X) =>{// in callback
                            this.login = X.data;
                            if(this.login == 1){
                                send('post','/createAUserMonster ',  this.monster );
                            }else{
                                alert("pls login");
                            }

                        } );

              },

          }
    }
</script>
