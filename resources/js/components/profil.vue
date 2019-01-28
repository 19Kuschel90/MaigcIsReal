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
                                <button v-on:click='send("post","/updateUserData",userData, 
                                () => {editSawp();
                                
                                }
                                 )'>Save</button>
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
    this.send('post','/profil' );
        },

        ////////////////////////////////////
          methods: {
              send(methode, url, data = null, toDoFUN = ()=>{}){
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
                                                    debugger;
                            this.userData["id"] = response.data.id;
                            this.userData["name"] = response.data.name;
                            this.userData["email"] = response.data.email;
                            console.log('response', response);

                        });
                            toDoFUN();
              },

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