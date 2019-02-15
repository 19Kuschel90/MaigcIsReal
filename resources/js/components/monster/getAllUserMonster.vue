<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card card-default">
                         <div v-if="monsterAllUser.length != 0">
                                    <div v-for="aMonster in monsterAllUser" class="card-body">
                                            <div >
                                                <component :is="monsterNotEdit" :monster="aMonster"></component>
                                                <button v-on:click='() => destroy(aMonster.id)'>destroy</button>
                                            </div>
                                    </div>
                                    </div>
                        <div v-else>
                            asdds
                            <router-link class="nav-link" to="/createAUserMonster">Create a Monster</router-link>
                        </div>

                </div>
            </div>
        </div>
  </div>
</template>

<script>
import {CMonster} from './CMonster.js';
import {send} from './../axiosSend.js';
import CmonsterNotEdit from './monsterNotEdit.vue';

    export default {
        mounted() {
            console.log('monsterEdit.');
        },
        data() {
            return {
                monsterNotEdit: CmonsterNotEdit,
                monsterAllUser: [],
            };
        },
        created(){
            this.getAllUserMonster();
        },

        methods:{

        destroy(id){
              send('post','/destroy', {"id":id });
                this.monsterAllUser =[];
               this.getAllUserMonster();
        },

            getAllUserMonster(){
                    send('post','/getAllUserMonster', null, (response) =>{
                                        response.data.forEach(element => {
                                                if(element == []){
                                                    return;
                                                }
                                                this.monsterAllUser.push({
                                                        "id": element.id,
                                                        "name": element.name,
                                                        "imgName": element.imgName,
                                                        "AP": element.AP,
                                                        "DP": element.DP,
                                                        "HP": element.HP,
                                                        "Speed": element.Speed,
                                                        "SpwanWert": element.SpwanWert,
                                                });
                                        });
                            } );
            },
        }


    }

</script>
