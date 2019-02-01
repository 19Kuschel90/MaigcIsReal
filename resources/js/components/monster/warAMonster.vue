<template>
  <div>
        <div>
                 <p>ID: {{ monsterA.id }} </p>
                <p>Name: {{ monsterA.name }}</p>
                  <p>Img Name: {{ monsterA.imgName }}</p>
                  <p>AP: {{ monsterA.AP }}</p>
                  <p>DP: {{ monsterA.DP }}</p>
                  <p>HP: {{ monsterA.HP }}</p>
                  <p>Speed: {{ monsterA.Speed }}</p>
                  <p>SpwanWert: {{ monsterA.SpwanWert }}</p>
  </div>
  //////////////////////////////
    <button v-on:click="war">Lets War</button>
  //////////////////////////////
  <div>
                 <p>ID: {{ monsterB.id }} </p>
                <p>Name: {{ monsterB.name }}</p>
                  <p>Img Name: {{ monsterB.imgName }}</p>
                  <p>AP: {{ monsterB.AP }}</p>
                  <p>DP: {{ monsterB.DP }}</p>
                  <p>HP: {{ monsterB.HP }}</p>
                  <p>Speed: {{ monsterB.Speed }}</p>
                  <p>SpwanWert: {{ monsterB.SpwanWert }}</p>
  </div>
 <div v-for="value in Outputs">
    {{ value}}
  </div>
  </div>

</template>

<script>
import {CMonster} from './CMonster.js';
    export default {
        mounted() {
            console.log('monsterEdit.');
        },
        data() {
            return {
                monsterA:new CMonster(),

                 monsterB: new CMonster(),
                 Outputs: []
            };
        },
        created(){
            this.send('post','/ramdomSpawn', {id: 1}, () =>{}, this.monsterA );
            this.send('post','/getAMonster', {id: 3}, () =>{}, this.monsterB );
        },
        methods:{
            war(){

             this.attack(
                 this.monsterA.name, this.monsterA.AP,this.monsterA.DP, this.monsterA.HP, this.monsterA.Speed,
                 this.monsterB.name, this.monsterB.AP,this.monsterB.DP, this.monsterB.HP, this.monsterB.Speed
             )
            },
            attack(
                _name,_AP,_DP, _HP, _Speed,
                _name2, _AP2, _DP2, _HP2, _Speed2
                )
            {
                if(_Speed >= _Speed2)
                {
                        this.hit(_name, _name2, _AP, _DP2, _HP2);
                    }else{
                        this.hit(_name2, _name, _AP2, _DP, _HP);

                        }
            },
            hit(name,name2,AP, DP, HP){
                            let damge =  DP - AP;
                            HP -=  damge;
                            this.addToOutput(name + "Damge: " + damge + " " + name2 +  " HP: " + HP);
                        if(HP <= 0)
                        {
                            this.addToOutput( name2 + " is lost" +  " HP: " + HP);
                            alert(name + " Lose");
                        }

            },
            addToOutput(text){
                this.Outputs.push(text);
            },
               send(methode, url, data = null, toDoFUN = ()=>{}, monster){
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

                            monster["id"] = response.data.id;
                            monster["name"] = response.data.name;
                            monster["imgName"] = response.data.imgName;
                            monster["AP"] = response.data.AP;
                            monster["DP"] = response.data.DP;
                            monster["DP"] = response.data.HP;
                            monster["Speed"] = response.data.Speed;
                            monster["SpwanWert"] = response.data.SpwanWert;
                            console.log('response', response);

                        });
                            toDoFUN();
                            } catch (error) {
                                console.error('Send Error: ', error);
                        }
              },

        },
        /**
         *   Monster:{
                    name: '',
                    imgName: '',
                    AP: -1,
                    DP: -1,
                    Speed: -1,
                    SpwanWert: -1,
                },
         */
         props: ["monster"],

    }

</script>
