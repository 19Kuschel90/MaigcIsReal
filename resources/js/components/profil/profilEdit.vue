<template>
  <div>
      <div>

           <p>ID: {{userData.id }}</p>
        <div>Name:<input v-model="userData['name']"></div>
        <div>E-mail:<input v-model="userData['email']"></div>
        <div>First Name:<input v-model="userData['firstName']"></div>
        <div>Last Name:<input v-model="userData['lastName']"></div>

     </div>


  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Edit.');
        },


         props: ["userData"],

    }

</script>
