import React, { useState } from 'react';
import './App.css';
import axios from 'axios';
import qs from 'qs'; // Import qs library, you might need to install it using npm

function App() {
  // State for handling form inputs
  const [nim, setNim] = useState('');
  const [nama, setNama] = useState('');
  const [semester, setSemester] = useState('');

  const handleAdd = async () => {
    try {
      const data = {
        nim: nim,
        nama: nama, 
        semester: semester,
      };

      const response = await axios.post('http://localhost/webapi/insertapi.php', qs.stringify(data), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      });

      console.log(response.data);
      setNim('');
      setNama('');
      setSemester('');
    } catch (error) {
      console.error(`Error: ${error}`);
    }
  };


  const handleDelete = async () => {
    try {
      const data = {
        nim: nim
      };

      const response = await axios.post('http://localhost/webapi/deleteapi.php', qs.stringify(data), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      });

      console.log(response.data);
      // Clear NIM field after deletion
      setNim('');
    } catch (error) {
      console.error(`Error: ${error}`);
    }
  };

  return (
    <div className="container mt-3">
      <div className="text-center">
        <h1>Kelompok 6 - CRUD</h1>
        <p>SBD 01</p>
        <hr />
      </div>
      <div className="card mb-3">
        <div className="card-header">Insert Data</div>
        <div className="card-body">
          <form onSubmit={(e) => {
            e.preventDefault();
            handleAdd();
          }}>
            <input type="text" className="form-control mb-2" placeholder="NIM" value={nim} onChange={(e) => setNim(e.target.value)} />
            <input type="text" className="form-control mb-2" placeholder="Nama" value={nama} onChange={(e) => setNama(e.target.value)} />
            <input type="text" className="form-control mb-3" placeholder="Semester" value={semester} onChange={(e) => setSemester(e.target.value)} />
            <button type="submit" className="btn btn-success">Add Data</button>
          </form>
        </div>
      </div>

      <div className="card">
        <div className="card-header">Delete Data</div>
        <div className="card-body">
          <form onSubmit={(e) => {
            e.preventDefault();
            handleDelete();
          }}>
            <input type="text" className="form-control mb-3" placeholder="NIM" value={nim} onChange={(e) => setNim(e.target.value)} />
            <button type="submit" className="btn btn-danger">Delete Data</button>
          </form>
        </div>
      </div>

      <div className="card my-3">
        <div className="card-header">Update Data</div>
        <div className="card-body">
          <input type="text" className="form-control mb-2" placeholder="NIM" />
          <input type="text" className="form-control mb-2" placeholder="Nama" />
          <input type="text" className="form-control mb-3" placeholder="Semester" />
          <button className="btn btn-primary">Update Data</button>
        </div>
      </div>

      <div className="card mb-3">
        <div className="card-header">Show Data</div>
        <div className="card-body">
          <a href="http://localhost/webapi/readapi.php"><button className="btn btn-info">Show Data</button></a>
        </div>
      </div>
    </div>
  );
}

export default App;
