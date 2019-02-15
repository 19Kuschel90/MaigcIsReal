<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body text-center">
                        <!-- <profilEdit userData="userData"></profilEdit> -->
                     <div v-if="edit">
                            <component :is="profilEdit" :user-data="userData" ></component>
                                <div>
                                    Layout:<select v-model="layout">
                                                <option  value="Dark">Dark</option>
                                                <option value="White">White</option>
                                                <option value="Green">Green</option>
                                        </select>
                                </div>
                                <button v-on:click="editSawp">back</button>
                                <button v-on:click='updateUserData'>Save</button>
                     </div>
                     <div v-else>
                            <component :is="profilNotEdit" :user-data="userData" :layout="layout"></component>
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
import {layout} from './../layout.js';
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
                    id: 'pls wait',
                    firstName: 'pls wait',
                    lastName: 'pls wait',
                },
                layout: new layout().getlayoutName(),
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
                            this.getUserFirstAndLastName();
    });
        },

        ////////////////////////////////////
          methods: {
              getUserFirstAndLastName(){
                    send('post','/getUserFirstAndLastName' , null, (response)=>{
                                                this.userData["firstName"] = response.data[0].firstName;
                                                this.userData["lastName"] = response.data[0].lastName;
                        });
              },
              updateUserFirstAndLastName(){
                    send('post','/updateUserFirstAndLastName' , this.userData, (response)=>{
                        // Too Do
                        });
              },

              updateUserData(){
                    send("post","/updateUserData",this.userData, () => {

                                    this.editSawp();
                                    window.MySetName(this.userData.name);
                                    this.updateUserFirstAndLastName();
                                    new layout().setLayout(this.layout);
                                       this.layout = new layout().getlayoutName();
                                       window.location.reload();
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
