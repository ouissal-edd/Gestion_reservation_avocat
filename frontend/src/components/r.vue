<template>
  <form @submit="CreateRDV">
    <label>Sujet:</label>
    <input type="text" required v-model="sujet" />
    {{ sujet }}

    <label>Choisissez une date:</label>
    <input type="date" required v-model="date" />
    {{ date }}
    <label>Choisissez le creneau qui vous correspand</label>
    <select name="heur" v-model="heur">
      <option>Check</option>
      <option value="1">10h:00 vers 10:30</option>
      <option value="2">11h:00 vers 11:30</option>
      <option value="3">14h:00 vers 14:30</option>
      <option value="4">15h:00 vers 15:30</option>
      <option value="5">16h:00 vers 16:30</option>
    </select>
    {{ heur }}

    <button type="submit">Envoyer</button>
    <!-- <button @click.prevent="CreateRDV()">Envoyer</button> -->
    <button @click="mylogout()">logout</button>
  </form>
</template>

<script>
export default {
  name: "r",
  data() {
    return {
      sujet: "",
      date: "",
      heur: "",
    };
  },
  methods: {
    async CreateRDV() {
      let res = await fetch(
        "http://localhost/Backend%20RDV/API/reservation/insertRDV",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            fk_user: sessionStorage.getItem("reference_user"),
            fk_creneau: this.heur,
            sujet: this.sujet,
            date: this.date,
          }),
        }
      );
      let data = await res.json();
      console.log(data);
    },
    mylogout: function () {
      sessionStorage.removeItem("reference_user");
      this.$router.push({ name: "ClientForm" });
    },
  },
};
</script>

<style>
form {
  max-width: 420px;
  margin: 30px auto;
  background: white;
  text-align: left;
  padding: 40px;
  border-radius: 10px;
}
label {
  color: rgb(5, 5, 5);
  display: inline-block;
  margin: 25px 0 15px;
  font-size: 0.6em;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}
input,
select {
  display: block;
  padding: 10px 6px;
  width: 100%;
  box-sizing: border-box;
  border: none;
  border-bottom: 1px solid #cea368;
  color: #555;
  outline: none;
}
select {
  margin-top: 30px;
  margin-bottom: 30px;
}
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
}

.submit {
  text-align: center;
}
</style>