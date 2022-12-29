<script setup>
</script>

<template>
  <VApp>
    <VAppBar color="grey-lighten-2">
      <!-- <RouterLink class="pr-4" to="/">Home</RouterLink>
      <RouterLink to="/test">Test Page</RouterLink> -->
    </VAppBar>
    <VNavigationDrawer color="grey-darken-2" :border="true" :elevation="10" expand-on-hover rail>
        v-navigation-drawer
    </VNavigationDrawer>
    <VMain style="background:orange">
      <VContainer fluid style="margin:initial;">
        <RouterView></RouterView>
      </VContainer>
    </VMain>
  </VApp>
</template>

<style>
#app{margin:0;max-width:100vw;padding:0 !important;flex: 1 1 auto;text-align:start;}
</style>
