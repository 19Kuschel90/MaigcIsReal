<template>
    <div class="container">
        <component :is="searchMonster" :monster="searchData.Monster"></component>
        <component :is="searchUserMonster" :usermonster="searchData.UserMonster"></component>
        <component :is="searchUser" :user="searchData.user"></component>
    </div>
</template>

<script>
import {send} from './../axiosSend.js';
import searchUserMonster from './searchUserMonster.vue';
import searchMonster from './searchMonster.vue';
import searchUser from './searchUser.vue';

    export default {
        mounted() {
            console.log('Component mounted.');
        },  data() {
            return {
                searchUserMonster: searchUserMonster,
                searchMonster: searchMonster,
                searchUser: searchUser,
                searchData: {
                    Monster:
                    [{
                        id: -1,
                        name: "none",
                        imgName: "none",
                        AP: -1,
                        DP: -1,
                        HP: -1,
                        Speed: -1,
                        created_at: -1,
                        updated_at: -1
                    }],
                       user:
                       [{
                        id: -1,
                        name: "none",
                    }],
                    UserMonster:
                    [{
                        id: -1,
                        name: "none",
                        imgName: "none",
                        idUser: -1,
                        AP: -1,
                        DP: -1,
                        HP: -1,
                        Speed: -1,
                        created_at: -1,
                        updated_at: -1
                    }],

                }
            };
        },
created() {
            // For adding the token to axios header (add this only one time).
    send('post','/search', {"search": "Heiko"}, (response) =>{
        this.searchData.Monster = response.data.Monster;
        this.searchData.user = response.data.User;
        this.searchData.UserMonster = response.data.UserMonster;
    });
        },


    }

</script>
