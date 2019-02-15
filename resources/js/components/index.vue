<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                   <div class="card-body text-center">
                <p>Welcome,

                  you can expect great <router-link  class="nav-link" to="/warAMonster">War Monster</router-link> battles
                  To participate in a fight you need to register and <router-link  class="nav-link" to="/createAUserMonster">create your own monster.</router-link>
                  but you can also  <router-link class="nav-link" to="/createAMonster">Create a Monster</router-link> against the monster button against which all registered users can fight.</p>
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
        created(){//search
              send('post','/getLastMonster', null, (response)=>{
                      this.monsters = response.data;
              } );
               this.myUpdata();

          },
    methods:{

                 myUpdata(){
            this.intervalid1 = setInterval(()=>{
                if(window.location.hash == '#/')
                {
                    send('post','/getLastMonster' );
                }
             }, this.updataTime);
        },

    }
}
</script>
