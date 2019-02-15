<template>
  <div>
      <div>
            <p>ID: {{userData.id }}</p>
            <p>Name: {{ userData.name }}</p>
            <p>E-mail: {{userData.email }}</p>
            <p>First Name: {{userData.firstName }}</p>
            <p>Last Name: {{userData.lastName }}</p>
            <p>Layout: {{ layout  }}</p>

  </div>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Edit.');
        },


         props: ["userData","layout"],

    }

</script>
