<template>
  <form @submit.prevent="handleSubmit">
    <label>Entrer votre code:</label>
    <input
      name="reference_user"
      type="text"
      placeholder="coller votre code ici"
      required
      v-model="reference_user"
    />
    <button type="submit">S'identifie</button>
    <!-- <div v-else>noo</div> -->
  </form>
</template>

<script>
export default {
  name: "clientFormulaire",
  data() {
    return {
      reference_user: "",
    };
  },
  methods: {
    async handleSubmit() {
      // const data = {
      //   reference_user: this.reference_user,
      // };
      let res = await fetch(
        "http://localhost/Backend%20RDV/API/users/connect_User",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            reference_user: this.reference_user,
          }),
        }
      );
      let data = await res.json();
      console.log(data.id);
      if (data.existe == true) {
        sessionStorage.setItem("reference_user", data.id);
        this.$router.push({ name: "Reservation" });
      }
    },
  },
  beforeMount() {
    if (sessionStorage.getItem("reference_user")) {
      this.$router.push({ name: "Reservation" });
    }
  },
};
</script>

<style>
form {
  max-width: 420px;
  margin: 150px auto;
  background: white;
  text-align: left;
  padding: 40px;
  border-radius: 10px;
}
label {
  color: rgb(19, 18, 18);
  display: inline-block;
  margin: 25px 0 15px;
  font-size: 0.6em;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}
input {
  display: block;
  padding: 10px 6px;
  width: 100%;
  box-sizing: border-box;
  border: none;
  border-bottom: 2px solid #cea368;
  color: #555;
  outline: none;
}
button {
  background: linear-gradient(45deg, black, #cea368);
  border: none;
  padding: 11px 90px;
  margin-top: 20px;
  margin-left: 20px;
  color: white;
  border-radius: 20px;
  cursor: pointer;
}
.submit {
  text-align: center;
}

a {
  font-weight: bold;
  color: white;
  text-decoration: none;
}
</style>