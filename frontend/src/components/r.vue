<template>
  <button id="out" @click="mylogout()">logout</button>

  <form @submit="CreateRDV">
    <label>Sujet:</label>
    <!-- v-model pour créer une liaison de données bidirectionnelle sur les champs de formulaire  -->
    <input type="text" required v-model="sujet" />

    <label>Choisissez une date:</label>
    <input
      type="date"
      @change="getTimeSlot"
      required
      v-model="date"
      :min="getTodayDate()"
    />
    <label>Choisissez le creneau qui vous correspand</label>
    <select name="heur" v-model="heur">
      <option v-for="o in obj" :key="o.id_creneau" :value="o.id_creneau">
        {{ o.heur }}
      </option>

      <!-- <option value="1">10h:00 vers 10:30</option>
      <option value="2">11h:00 vers 11:30</option>
      <option value="3">14h:00 vers 14:30</option>
      <option value="4">15h:00 vers 15:30</option>
      <option value="5">16h:00 vers 16:30</option> -->
    </select>

    <button type="submit" v-if="hundelUpdate">Envoyer</button>
    <button @click="UpdateRDV()" v-if="!hundelUpdate">Modifier</button>
    <label>Vous avez deja effectuer des reservation :</label>
    <button>
      <router-link to="/gestionReservation">Voir mes RDV</router-link>
    </button>
  </form>
</template>

<script>
export default {
  name: "r",
  data() {
    return {
      id_RDV: this.$route.params.name,
      hundelUpdate: true,
      sujet: "",
      date: "",
      heur: "",
      obj: "",
    };
  },
  methods: {
    getTodayDate() {
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, "0");
      var mm = String(today.getMonth() + 1).padStart(2, "0");
      var yyyy = today.getFullYear();
      today = yyyy + "-" + mm + "-" + dd;
      return today;
    },
    getTimeSlot() {
      var myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/json");

      var raw = JSON.stringify({
        date: this.date,
      });

      var requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow",
      };
      var self = this;
      fetch(
        "http://localhost/Backend%20RDV/API/reservation/verificationCreneau",
        requestOptions
      )
        .then((response) => response.text())
        .then(function (result) {
          console.log(result);
          var availableTimes = JSON.parse(result);
          console.log(availableTimes);
          self.obj = availableTimes;
        })
        .catch((error) => console.log("error", error));
    },
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
    getSingelAppointment: async function (idRDV) {
      let res = await fetch(
        "http://localhost/Backend%20RDV/API/reservation/GetSpecifique",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            id_RDV: idRDV,
          }),
        }
      );
      let [data] = await res.json();

      console.log(data);
      this.date = data.date;
      this.sujet = data.sujet;
      this.heur = data.heur;
      (this.hundelUpdate = idRDV != "" ? false : true),
        //   this.dataUpdated = data;
        this.$router.push({ path: "/r", params: { myData: data } });
    },
    UpdateRDV: async function () {
      let res = await fetch(
        "http://localhost/Backend%20RDV/API/reservation/update",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            id_RDV: this.id_RDV,
            date: this.date,
            fk_creneau: this.heur,
            sujet: this.sujet,
          }),
        }
      );
      let data = await res.json();
      console.log(data);
      this.$router.push({ path: "/gestionReservation" });
    },
    mylogout: function () {
      sessionStorage.removeItem("reference_user");
      this.$router.push({ name: "ClientForm" });
    },
  },
  beforeMount() {
    console.log(this.id_RDV);
    this.getSingelAppointment(this.id_RDV);
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
  padding: 11px 40px;
  margin-top: 20px;
  margin-left: 20px;
  color: white;
  border-radius: 20px;
  margin: auto;
  letter-spacing: 2px;
  cursor: pointer;
}

.submit {
  text-align: center;
}

#out {
  float: right;
  margin-top: 1%;
  padding: 11px 40px;
  margin-right: 2%;
  background: none;
  border: solid #cea368;
  color: #cea368;
}
#out:hover {
  background: linear-gradient(45deg, black, #cea368);
  padding: 11px 40px;
  border: none;
  color: white;
}
a {
  color: #fff;
  text-decoration: none;
}
</style>