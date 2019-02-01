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

    export default {
        mounted() {
            console.log('Component mounted showAMonster.')
        },
        created(){
            if(!this.stopRun)
            {
                this.send('post','/getAMonster', {id: 1});
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
        props: ["monster", "stopRun"],
        methods:{
             send(methode, url, data = null, toDoFUN = ()=>{}){
                 try {

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

                            this.monster["id"] = response.data.id;
                            this.monster["name"] = response.data.name;
                            this.monster["imgName"] = response.data.imgName;
                            this.monster["AP"] = response.data.AP;
                            this.monster["DP"] = response.data.DP;
                            this.monster["DP"] = response.data.HP;
                            this.monster["Speed"] = response.data.Speed;
                            this.monster["SpwanWert"] = response.data.SpwanWert;
                            console.log('response', response);

                        });
                            toDoFUN();
                            } catch (error) {
                                console.error('Send Error: ', error);
                        }
              },
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
