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
                <component :is="showAMonster" :monsterProps="value" :stopRun='stopRun'></component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CshowAMonster from './monster/showAMonster.vue';
import {send} from './axiosSend.js';

    export default {
        mounted() {
            console.log('Component mounted.');

        },
         data() {
            return {
                updataTime: 15000,
             showAMonster: CshowAMonster,
                monsters: [],
                stopRun: true,
                othis: this
            }

        },
        created(){
              send('post','/getLastMonster', null, (response)=>{
                      this.monsters = response.data.reverse();
              } );
               this.myUpdata();
          },
    methods:{

                 myUpdata(){
            this.intervalid1 = setInterval(()=>{
              send('post','/getLastMonster' );
             }, this.updataTime);
        },

    }
}
</script>
