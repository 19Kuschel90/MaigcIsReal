<template>
<nav class="navbar navbar-expand-lg navbar-dark " v-bind:style="layout.nav" >
  <router-link class="navbar-brand" to="/">
   <h1 style="font-size: 2rem"> <canvas id="logo" width="30" height="30">Webgl no support</canvas>
   Maigc is real</h1>
  </router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" style="font-size: 1.1rem">
      <li class="nav-item active">
        <router-link class="nav-link" to="/">Home <span class="sr-only">(current)</span></router-link>
      </li>
      <li class="nav-item active">
        <router-link class="nav-link" to="/createAMonster">Create a Monster</router-link>
    </li>
      <li class="nav-item dropdown active" v-if="userName != ''">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ userName }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <router-link  class="dropdown-item" to="/createAUserMonster">Create Your Own Monster</router-link>
          <router-link  class="dropdown-item" to="/warAMonster">War Monster</router-link>
          <router-link  class="dropdown-item" to="/getAllUserMonster">Show your Monsters</router-link>
          <div class="dropdown-divider"></div>
          <router-link class="dropdown-item" to="/profil">Profil</router-link>
          <a class="dropdown-item" href="/logout">logout</a>
        </div>
      </li>
        <li class="nav-item active" v-else>
            <a class="nav-link" href="/login">login</a>
      </li>


    </ul>
    <div class="form-inline my-2 my-lg-0" >
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="search">
      <div  class="btn btn-outline-success my-2 my-sm-0"  v-on:click="moveToSearch" >Search</div >
    </div>
  </div>
</nav>
</template>

<script>
import {CLogo} from './../logo/logoWebGL.js';
import {send} from './../axiosSend.js';
import {layout} from './../layout.js';

    export default {
        mounted() {
            console.log('Component mounted.');
        },
        data(){
            return{
                logo: null,
                userName: '',
                search:'',
                 layout: '',

            }
        },
        created(){
            this.layout = new layout().getColor();
            window.MySetName = this.setName;
           this.logo = new CLogo('glsl/shader.vs.glsl', 'glsl/shader.fs.glsl', 'model3D/jsom/Logo4.json', 'img/172.JPG', "logo");
           send('post', '/getUserName', null, (response) =>{
               if(response.data != 0){
                   this.userName = response.data;
               }else{
                   this.userName = '';
               }
           } );
        },
        methods: {
            setName(name){
                   this.userName = name;
            },
            moveToSearch(){
                window.location.hash = '#/search/' + this.search;
                    location.reload();
            }

        }

}



</script>
