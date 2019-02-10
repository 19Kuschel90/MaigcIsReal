<template>
  <div>
      <div>
            <p>ID: {{userData.id }}</p>
            <p>Name: {{ userData.name }}</p>
            <p>E-mail: {{userData.email }}</p>
            <p>Firstname: {{userData.firstName }}</p>
            <p>Lastname: {{userData.lastName }}</p>
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
