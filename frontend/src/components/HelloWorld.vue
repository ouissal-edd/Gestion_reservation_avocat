<template>
  <div class="hello">
    <h1>We are a justice</h1>

    <p>
      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorem
      consequatur expedita totam provident eveniet veritatis aut temporibus.
      Consequatur deserunt iste corrupti ducimus perferendis eveniet, delectus
      voluptatem quos fuga sequi voluptatum.
    </p>
    <div class="Btn">
      <button>
        <router-link to="/clientFormulaire">RESERVE </router-link>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "HelloWorld",
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
.hello {
  background: linear-gradient(rgba(0, 0, 0, 0.404), rgba(0, 0, 0, 0.527)),
    url(../assets/jus.jpg);
  min-height: 89vh;
  background-size: cover;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  h1 {
    color: #fff;
    font-size: 35px;
  }
  p {
    color: #fff;
    font-size: 17px;
    margin-bottom: 5%;
    margin-top: 1%;
    width: 50%;
  }
  .Btn {
    button {
      background: linear-gradient(45deg, black, #cea368);
      border: none;
      padding: 18px 90px;
      margin-top: 20px;
      margin-left: 20px;
      color: white;
      border-radius: 20px;
      margin: auto;
      letter-spacing: 2px;
      a {
        color: #fff;
        text-decoration: none;
      }
    }
  }
}
</style>
