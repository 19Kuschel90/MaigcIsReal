<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                        <!-- <profilEdit userData="userData"></profilEdit> -->
                     <div v-if="edit">
                            <component :is="profilEdit" :user-data="userData"></component>
                                <button v-on:click="editSawp">back</button>
                                <button v-on:click='updateUserData'>Save</button>
                     </div>
                     <div v-else>
                            <component :is="profilNotEdit" :user-data="userData"></component>
                        <button v-on:click="editSawp">Edit</button>
                     </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import profilEdit from './profilEdit.vue';
import profilNotEdit from './profilNotEdit.vue';
import {send} from './../axiosSend.js';

    export default {
        mounted() {
            console.log('Component mounted.');
        },  data() {
            return {
                profilEdit: profilEdit,
                profilNotEdit: profilNotEdit,
                userData:{
                    name: 'pls wait',
                    email: 'pls wait',
                    id: 'pls wait'

                },
                editSawp: this.editSawp,
              edit: false,
            };
        },
created() {
            // For adding the token to axios header (add this only one time).
    send('post','/profil' , null, (response)=>{
                            this.userData["id"] = response.data.id;
                            this.userData["name"] = response.data.name;
                            this.userData["email"] = response.data.email;
    });
        },

        ////////////////////////////////////
          methods: {
              updateUserData(){
        send("post","/updateUserData",this.userData, () => {
                                    this.editSawp();
                                    // this.$emit('setName', this.userData.name);
                                    window.MySetName(this.userData.name);
                                }) },

    editSawp() {
        if(this.edit)
        {
            this.edit = false;
        }else{
            this.edit = true;
        }
    }
  }
    }

</script>
