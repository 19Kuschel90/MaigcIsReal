<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <div>
                         <img v-bind:src="'img/'+ monster.imgName" class="rounded float-right w-25" alt="Monster">
                          <div>Name:<input v-model="monster['name']"></div>
                          <select v-model="monster.imgName">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                            </select>
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
import {send} from './../axiosSend.js';
import {monsterImgNameList} from './../monsterImgNameList.js';

    export default {
        mounted() {
            console.log('Component mounted.');
            this.monster
        },
        created(){

            this.monster.imgName = monsterImgNameList[0]["value"];

        },
         data() {
            return {
             monster: new CMonster(),
                options: monsterImgNameList
            };
        },
          methods:{
              create(){
                 send('post','/createAMonster ',  this.monster, (response) => {
                    // router.push({ path: `/getAMonster/${3}` });
                     window.location.hash = '#/'
                 });
              },



          }
    }
</script>
