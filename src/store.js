import axios from "axios";

export default {
  name: "store",
  state: {
    piles: {},
    activePile: null,
    activeStack: null,
    alerts: {},
    loaded: false
  },
  loadAllPiles() {
    return new Promise((resolve, reject) => {
      axios
        .get(`/api/piles`)
        .then(response => {
          // JSON responses are automatically parsed.
          this.state.piles = response.data;
          this.state.loaded = true;
          resolve();
        })
        .catch(e => {
          reject();
          throw new TypeError("Unable to fetch piles from API server. " + e);
        });
    });
  },
  addPileById(id) {
    axios
      .get(`/api/pile/${id}`)
      .then(response => {
        // JSON responses are automatically parsed.
        this.addPile(response.data);
      })
      .catch(e => {
        throw new TypeError(
          `Unable to fetch pile from API server with ID ${id}. ${e}`
        );
      });
  },
  addPile(pile) {
    this.state.piles[pile.id] = pile;
  },
  removePile(id) {
    delete this.state.piles[id];
  },
  setActivePile(id) {
    return new Promise((resolve, reject) => {
      if (this.state.piles.hasOwnProperty(id)) {
        this.state.activePile = id;
        resolve();
      } else {
        this.loadAllPiles().then(() => {
          if (this.state.piles.hasOwnProperty(id)) {
            this.state.activePile = id;
            resolve();
          } else {
            reject();
            throw new TypeError(
              "Pile with ID does not exist in the piles object."
            );
          }
        });
      }
    });
  },
  getActivePile() {
    return this.state.piles[this.state.activePile];
  },
  addAlert(msg, type) {
    this.state.alerts[+new Date()] = {
      message: msg,
      type: type
    };
    this.state.alerts = Object.assign({}, this.state.alerts);
  },
  removeAlert(key) {
    delete this.state.alerts[key];
    this.state.alerts = Object.assign({}, this.state.alerts);
  }
};
