import React from "react";
import axios from 'axios';
import {apiserver} from "../config/config";

import { useNavigate } from "react-router-dom";
import { useState } from 'react';




export default function Login(){


    const [message, setMessage] = useState('');

    const handleSubmit = async (event) => {

        event.preventDefault();
        const data = new FormData(event.target);

        const payload = {
            un: data.get('username'),
            pss: data.get('password')
        };

        console.log(payload);

        try {
            const response = await axios.post(apiserver + 'authenticate', payload);
            if (response.status === 201) {
                setMessage('Data inserted successfully');
                console.log(response);
                // Reset form or display success message
            }
        } catch (error) {
            setMessage('Error inserting data');
            console.error('Error:', error);
        }


    };



    return (
        <div>
            <h1>Login page</h1>

            <form onSubmit={handleSubmit}>
                <input type="text" className="form-control form-control-user"
                id="exampleInputEmail" aria-describedby="emailHelp"
                placeholder="Enter Email Address..." name="username"/>
                <input type="password" className="form-control form-control-user"
                id="exampleInputPassword" placeholder="Password" name="password"/>
                <button type="submit" className="btn btn-primary btn-user btn-block"> Login </button>
            </form>
        </div>
    );

}