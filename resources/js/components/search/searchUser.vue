<template>
    <div class="container">

         <div> User
             <div v-if="user.length != 0 && user[0].id != -1">

     <table class="table">

  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>

    </tr>
  </thead>
  <tbody>
    <tr v-for="value in user">
      <th scope="row" >{{ value.id }}</th>
      <th scope="row" >{{ value.name }}</th>

    </tr>

  </tbody>
</table>
             </div>
             <div v-else>
                 Not User Found
             </div>
         </div>
    </div>
</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted searchMonster.');

        },
   props: ["user"],
created() {
            // For adding the token to axios header (add this only one time).

        },


    }

</script>
