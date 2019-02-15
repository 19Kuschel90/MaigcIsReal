<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Create your own Monster</div>

                    <div class="card-body">
                        <div>
                         <img v-bind:src="'img/'+ monster.imgName" class="rounded float-right w-25" alt="Monster">
                          <div>Name:<input v-model="monster['name']"></div>
                                <select v-model="monster.imgName">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                            </select>
                          <div>AP:<input v-model="monster['AP']" type="number"></div>
                          <div>DP:<input v-model="monster['DP']" type="number"></div>
                          <div>HP:<input v-model="monster['HP']" type="number"></div>
                          <div>Speed:<input v-model="monster['Speed']" type="number"></div>
                          <div>SpwanWert:<input v-model="monster['SpwanWert']" type="number"></div>
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
import {monsterImgNameList} from './../monsterImgNameList.js';

    export default {
        mounted() {
            console.log('Component mounted.');
        },
        created(){
            this.monster.imgName = monsterImgNameList[0]["value"];
            // check login and verify
             send('post','/iMLogin ',  null, (response) =>{
                            this.login = response.data;

            if(this.login != 1){
                        alert("pls login or verify your Acc");
                                window.location.hash = '#/';

                }

             });
        },
         data() {
            return {
             monster: new CMonster(),
             login: 0,
                options: monsterImgNameList
            };
        },
          methods:{
              create(){

                        send('post','/iMLogin ',  null, (response) =>{// in callback
                            this.login = response.data;
                            if(this.login == 1){
                                send('post','/createAUserMonster ',  this.monster );
                                window.location.hash = '#/';

                            }else{
                                alert("pls login or verify your Acc");
                            }

                        } );

              },

          }
    }
</script>
