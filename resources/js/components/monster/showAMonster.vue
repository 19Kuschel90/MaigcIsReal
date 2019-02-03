<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Show a Monster</div>

                    <div class="card-body">

                            <div v-if="edit">
                            <component :is="monsterEdit" :monster="monster"></component>
                                <button v-on:click="editSawp">back</button>
                                <button v-on:click='send("post","/updateUserData",userData,
                                () => {
                                    editSawp();
                                }
                                 )'>Save</button>
                     </div>
                     <div v-else>

                            <component :is="monsterNotEdit" :monster="monster"></component>
                        <button v-on:click="editSawp">Edit</button>
                     </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CmonsterEdit from './monsterEdit.vue';
import CmonsterNotEdit from './monsterNotEdit.vue';
import {CMonster} from './CMonster.js';
import {send} from './../axiosSend.js';

    export default {
        mounted() {
            console.log('Component mounted showAMonster.')
        },
        created(){
            if(this.stopRun )
            {
                this.monster =   this.monsterProps;
            }else{
                    send('post','/getAMonster',
                    {id: (window.location.hash[window.location.hash.length -1])}, // z.b: http://127.0.0.1:8000/home?#/getAMonster/6 = 6
                    (response) => {
                         this.monster["id"] = response.data.id;
                                this.monster["name"] = response.data.name;
                                this.monster["imgName"] = response.data.imgName;
                                this.monster["AP"] = response.data.AP;
                                this.monster["DP"] = response.data.DP;
                                this.monster["DP"] = response.data.HP;
                                this.monster["Speed"] = response.data.Speed;
                                this.monster["SpwanWert"] = response.data.SpwanWert;
                    });
            }
        },

         data() {
            return {
                monster: new CMonster(),
                edit: false,
                monsterEdit: CmonsterEdit,
                monsterNotEdit: CmonsterNotEdit,
                intervalid1: () => {},

            };
        },
        props: ["monsterProps", "stopRun"],
        methods:{

             editSawp() {
        if(this.edit)
        {
            this.edit = false;
        }else{
            this.edit = true;
        }
    },

            },

        }
</script>
