<script type="module">
  // Import the functions you need from the SDKs you need
  import {
    initializeApp
  } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-app.js";
  import {
    getAnalytics
  } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-analytics.js";
  import {
    getFirestore,
    doc,
    collection,
    getDoc,
    getDocs,
    addDoc,
    setDoc,
    updateDoc,
    deleteDoc,
    deleteField,
    serverTimestamp
  } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-firestore.js";
  import {
    getStorage,
    ref,
    getDownloadURL,
    getBlob
  } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-storage.js"
  import {
    getAuth,
    onAuthStateChanged,
    signInAnonymously
  } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-auth.js"
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  //https://firebase.google.com/docs/firestore/manage-data/add-data#set_a_document

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyD0GpK3fYSuvQT_8KGYs24uFQPCWqA7mj8",
    authDomain: "sitadik-9720b.firebaseapp.com",
    projectId: "sitadik-9720b",
    storageBucket: "sitadik-9720b.appspot.com",
    messagingSenderId: "105240806596",
    appId: "1:105240806596:web:7fef84675a1c8fa8237591",
    measurementId: "G-B6ZRV1Z2YF"
  };


  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
  const db = getFirestore(app);
  const storage = getStorage();
  const auth = getAuth();

  signInAnonymously(auth)
    .then((res) => {
      // Signed in..
      console.log(res)

    })
    .catch((error) => {
      const errorCode = error.code;
      const errorMessage = error.message;
      // ...
    });

  onAuthStateChanged(auth, (user) => {
    if (user) {
      console.log(user)
      ambilDb(db, "user").then(res => {
        res.forEach((isi, idx, arr)=>{
          console.log(isi.id)
          console.log(isi.data.foto)
        })
      })
    } else {
      console.log("KEluar")
    }
  })

  function AmbilFotoPegawai(pathFoto) {
    getDownloadURL(ref(storage, pathFoto)).
    then((url) => {
      console.log(url)
    })

  }

  // console.log(db)
  // Get a list of cities from your database
  async function ambilDb(db, key) {
    const koleksi = collection(db, key);
    const hasilKoleksi = await getDocs(koleksi);
    // const hasilList = hasilKoleksi.docs.map(doc => {
    //   doc.data()
    // });
    let arr = []
    hasilKoleksi.forEach((doc) => {
      // doc.data() is never undefined for query doc snapshots
      arr.push({
        id: doc.id,
        data: doc.data()
      });
    });
    return arr;
  }



  //================ AUTO ID ==========================================//
  async function TulisAutoId(key, data) { // data => json
    const ref = collection(db, key);

    const isi = await addDoc(ref, data)
      .then(() => {
        alert("data tersimpan")
      })
      .catch((err) => {
        alert("Error : " + err)
      })
  }

  // alert("ID anda : " + isi.id)

  //============== COSTUM ID ===========================================//   
  async function TulisCostumId(key, data, kostumId) { // data => json
    const ref = doc(db, key, kostumId);

    await setDoc(ref, data)
      .then(() => {
        alert("data tersimpan")
      })
      .catch((err) => {
        alert("Error : " + err)
      })
  }

  //============ BACA DB ===============================================//
  async function BacaDb(key, data, unikId) { // data => json
    const ref = doc(db, key, unikId);

    const hasil = await getDoc(ref)

    if (hasil.exists()) {
      alert(hasil.data())
    } else {
      alert("data tidak ditemukan")
    }
  }

  //============== UPDATE DB ==========================================//
  async function UpdateDb(key, data, unikId) { // data => json
    const ref = doc(db, key, unikId);

    await updateDoc(ref, data)
      .then(() => {
        alert("data terupdate")
      })
      .catch((err) => {
        alert("Error : " + err)
      })
  }

  //============ DELETE DB ===============================================//
  async function DeleteDb(key, data, unikId) { // data => json
    const ref = doc(db, key, unikId);

    const hasil = await getDoc(ref)

    if (!hasil.exists()) {
      alert("data yang akan dihapus tidak ditemukan")
    }

    await deleteDoc(ref)
      .then(() => {
        alert("data berhasil dihapus")
      })
      .catch((err) => {
        alert(err)
      })
  }