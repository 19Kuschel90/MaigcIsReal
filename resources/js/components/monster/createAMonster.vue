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
import {send} from './../axiosSend.js';

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
                 send('post','/createAMonster ',  this.monster, (response) => {
                    router.push({ path: `/getAMonster/${3}` });
                 });
              },



          }
    }
</script>
