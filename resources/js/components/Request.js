import React, { useState, useEffect, useContext } from 'react';
import ReactDOM from 'react-dom';
import ChatBot, { Loading } from 'react-simple-chatbot';
import axios from 'axios';
import Env from '../env';

const URL = `${Env.urlApi}/botman`;
// all available props
const theme = {
    background: '#f5f8fb',
    fontFamily: 'Helvetica Neue',
    headerBgColor: '#EF6C00',
    headerFontColor: '#fff',
    headerFontSize: '15px',
    botBubbleColor: '#EF6C00',
    botFontColor: '#fff',
    userBubbleColor: '#fff',
    userFontColor: '#4a4a4a',
};

function Request() {
    
    const [message, setMessage] = useState("");
    const [loading, setLoading] = useState(true);
    const [result, setResult] = useState(true);

    useEffect(() => {
        requestBotMan();
      }, []);

    const requestBotMan = () => {
        let dataconsume = {
            "driver":"web",
            "userId":"rtpvdi",
            "message":"Pedro",
            "attachment":null,
            "interactive":0
        };
        axios.post(`${URL}`, dataconsume).then(
            res => {
                console.log("Trayendo datos")
                setMessage(res.data.messages[0].text);
                setLoading(false);
            }
        )
    }
    return (
        <div>
            { loading ? <Loading /> : message }
        </div>
    )
}

export default Request;

