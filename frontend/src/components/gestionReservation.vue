<template>
  <div class="dashboard">
    <div class="container">
      <center><h1>Mes Reservations</h1></center>
      <button><router-link to="/r">Return</router-link></button>

      <center>
        <table>
          <thead>
            <tr>
              <!-- <th>id rdv</th> -->
              <th>Nom</th>
              <th>Date</th>
              <th>Creneau</th>
              <th>Subject</th>
              <th>edition</th>
              <th>supp</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="table in tables" :key="table.id_RDV">
              <!-- <td>{{ table.id_RDV }}</td> -->
              <td>{{ table.nom }}</td>

              <td scope="row">{{ table.date }}</td>
              <td>{{ table.heur }}</td>
              <td>{{ table.sujet }}</td>
              <th>
                <button @click="getIdAppointment(table.id_RDV)">Edite</button>
              </th>
              <button @click="delete table.id_RDV">delete</button>
            </tr>
          </tbody>
        </table>
      </center>
    </div>
  </div>
</template>

<script>
export default {
  name: "dashboard",
  data() {
    return {
      nom: "",
      date: "",
      id_RDV: "",
      fk_creneau: "",
      sujet: "",
      tables: {},
      dataUpdated: {},
      pageUpdate: false,
    };
  },
  methods: {
    async deletRDV() {
      var myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/json");

      var raw = JSON.stringify({
        id_RDV: this.id_RDV,
      });

      var requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow",
      };

      fetch(
        "http://localhost/Backend%20RDV/API/reservation/delete.php",
        requestOptions
      )
        .then((response) => response.text())
        .then((result) => console.log(result))
        .catch((error) => console.log("error", error));
    },

    edit(table) {
      this.pageUpdate = true;
      sessionStorage.setItem("nom", table.nom);
      sessionStorage.setItem("date", table.date);
      sessionStorage.setItem("fk_creneau", table.fk_creneau);
      sessionStorage.setItem("sujet", table.sujet);
      sessionStorage.setItem("id_RDV", table.id_RDV);
      this.redirection();
    },

    getClientAppointment: async function () {
      let res = await fetch(
        "http://localhost/Backend%20RDV/API/reservation/readSingle",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            id_user: sessionStorage.getItem("reference_user"),
          }),
        }
      );
      let data = await res.json();

      //   console.log(data);
      this.tables = data;
    },
    getIdAppointment: function (idRDV) {
      this.id_RDV = idRDV;
      this.$router.push({ name: "Reservation", params: { name: this.id_RDV } });
    },
  },
  beforeMount() {
    this.getClientAppointment();
  },
};
</script>
<style >
table,
th,
td {
  border: 1px solid black;
  color: black;
}
table {
  width: 100%;
}
table {
  border-collapse: collapse;
}
table {
  border: 1px solid black;
  font-family: -webkit-body;
}
h1 {
  color: black;
}
button {
  background: linear-gradient(45deg, black, #cea368);
  padding: 11px 40px;
  border: none;
  color: white;
  margin-bottom: 1%;
  margin-top: 1%;
}
a {
  color: #fff;
  text-decoration: none;
}
</style>