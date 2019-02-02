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
import {send} from './axiosSend.js';

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
              send('post','/getLastMonster', null, (response)=>{
                      this.monsters = response.data.reverse();
              } );
              this.updata();
          },
    methods:{

                 updata(){
            this.intervalid1 = setInterval(()=>{
              this.send('post','/getLastMonster' );
             }, this.updataTime);
        },

    }
}
</script>
