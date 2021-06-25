<template>
  <div class="header">
    <div class="logo"><img alt="logo" src="../../assets/logo.png" /></div>
    <div id="nav">
      <ul>
        <li>
          <router-link to="/" tag="li" exact>
            <a>Acceuil</a>
          </router-link>
          <router-link to="/clientFormulaire" tag="li" exact replace>
            <a>Login</a>
          </router-link>
          <router-link to="/firstFormulaire" tag="li" exact>
            <a>Register</a>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "headerApp",
};
</script>

<style lang="scss" scoped>
.header {
  background-color: rgb(7, 7, 7);
  overflow: hidden;

  .logo {
    width: 60px;
    margin-top: 1%;
    float: left;
    margin-left: 3%;

    img {
      width: 100%;
    }
  }
  #nav {
    padding: 12px;
    ul {
      text-align: center;
      width: calc(100% -200px);
      li {
        padding: 20px;
        display: inline-block;
        font-size: 18px;
        a {
          color: whitesmoke;
          text-decoration: none;
          margin-right: 5%;
        }
      }
    }
  }
}
</style>