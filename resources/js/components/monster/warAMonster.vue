<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
        <div>
                <img v-bind:src="'img/'+ monsterA.imgName" class="rounded float-right w-25" alt="Monster">
                 <p>ID: {{ monsterA.id }} </p>
                <p>Name: {{ monsterA.name }}</p>
                  <p>AP: {{ monsterA.AP }}</p>
                  <p>DP: {{ monsterA.DP }}</p>
                  <p>HP: {{ monsterA.HP }}</p>
                  <p>Speed: {{ monsterA.Speed }}</p>
                  <p>SpwanWert: {{ monsterA.SpwanWert }}</p>
  </div>
  //////////////////////////////
                <button v-on:click="war">Lets War</button>
                <button v-on:click="rest">Rest</button>
                <div v-for="value in Outputs">
                {{ value}}
  </div>
  //////////////////////////////

  <div v-if="monsterB != false">
                <img v-bind:src="'img/'+ monsterB.imgName" class="rounded float-right w-25" alt="Monster">
                 <p>ID: {{ monsterB.id }} </p>
                <p>Name: {{ monsterB.name }}</p>
                  <p>AP: {{ monsterB.AP }}</p>
                  <p>DP: {{ monsterB.DP }}</p>
                  <p>HP: {{ monsterB.HP }}</p>
                  <p>Speed: {{ monsterB.Speed }}</p>
                  <p>SpwanWert: {{ monsterB.SpwanWert }}</p>
  </div>
  <div v-else>



                    <div v-if="monsterAllUser.length != 0">

  <div v-for="aMonster in monsterAllUser" class="card-body">
                <div  v-on:click="monsterB = aMonster">
                    <component :is="monsterNotEdit" :monster="aMonster"></component>
            </div>
        </div>
                </div>

             <div v-else>
                      <router-link class="nav-link text-center alert alert-danger get4rem" to="/createAUserMonster">Create your Monster</router-link>
                </div>
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
                monsterA: new CMonster(),
                monsterNotEdit: CmonsterNotEdit,

                 monsterB: false,
                 monsterAllUser: [],
                 Outputs: []
            };
        },
        created(){
       this.ramdomSpawn();
        this.getAllUserMonster();

        },
        methods:{
            ramdomSpawn(){

                    send('post','/ramdomSpawn', null, (response) =>{
                                            this.monsterA["id"] = response.data.id;
                                            this.monsterA["name"] = response.data.name;
                                            this.monsterA["imgName"] = response.data.imgName;
                                            this.monsterA["AP"] = response.data.AP;
                                            this.monsterA["DP"] = response.data.DP;
                                            this.monsterA["HP"] = response.data.HP;
                                            this.monsterA["Speed"] = response.data.Speed;
                                            this.monsterA["SpwanWert"] = response.data.SpwanWert;
                            });
            },
            getAllUserMonster(){
                    send('post','/getAllUserMonster', null, (response) =>{
                                        response.data.forEach(element => {
                                                this.monsterAllUser.push({
                                                        "id": element.id,
                                            "name": element.name,
                                            "imgName": element.imgName,
                                            "AP": element.AP,
                                            "DP": element.DP,
                                            "HP": element.HP,
                                            "Speed": element.Speed,
                                            "SpwanWert": element.SpwanWert,
                                                })
                                        });
                            } );
            },

            war(){
                if(this.monsterB == false)
                {
                    alert('pls pick a Monster');
                    return;
                }

               if(this.monsterA.Speed >= this.monsterB.Speed)
                {
                    this.monsterA.Speed = 0;
                    this.monsterB.Speed = 1;
                        this.hit(this.monsterA,this.monsterB );

                    }else{
                        this.monsterB.Speed = 0;
                        this.monsterA.Speed = 1;
                        this.hit( this.monsterB, this.monsterA);
                    }
            },




            hit(A, B){
                            let damge =  A.DP - B.AP;
                            A.HP -=  damge;
                            if(damge < 1)
                            {
                            this.addToOutput('No Damge');
                            return;
                            }
                            this.addToOutput(B.name + "Damge: " + damge + " " + A.name2 +  " HP: " + A.HP);
                        if(A.HP <= 0)
                        {
                            this.addToOutput( A.name + " is lost" +  " HP: " + B.HP);
                            alert( B.name + "Damge: " + damge + " " + A.name2 +  " HP: " + A.HP + '\n'+
                                A.name + " Lose");
                                this.rest();
                        }

            },
            rest(){
                            this.ramdomSpawn();
                            this.monsterAllUser = [];
                            this.getAllUserMonster();
                            this.monsterB = false;
                            this.Outputs = [];
            },
            addToOutput(text){
                this.Outputs.push(text);
            },


        },



         props: ["monster"],

    }

</script>
