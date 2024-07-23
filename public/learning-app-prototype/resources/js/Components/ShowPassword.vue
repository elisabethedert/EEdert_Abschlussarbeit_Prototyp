<script setup>
/**
 * shows password
 */
function showPw() {
  var pw = document.getElementById("password");
  if (pw.type === "password") {
    pw.type = "text";
    console.log("text");
  } else {
    pw.type = "password";
    console.log("pw");
  }
} 
</script>

<template>
  <div class="checkbox">
    <input id="check" type="checkbox" @click="showPw()">
    <label for="check">Passwort zeigen </label>
  </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.checkbox {
  display: flex;
  gap: 0.5rem;
  margin-top: 0.5rem;
}

#check {
  border-radius: 3px;
  border: 2px solid $blue;
}
</style>