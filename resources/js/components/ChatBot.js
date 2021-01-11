import React, { useState, useEffect, useContext } from 'react';
import ReactDOM from 'react-dom';
import ChatBot, { Loading } from 'react-simple-chatbot';
import axios from 'axios';
import Env from '../env';
import RequestComp from './Request';

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


function ChatBotCom() {
    
    return (
        <ChatBot
        steps={[
          {
            id: '1',
            message: 'Hello, How can I help you?',
            trigger: 'search',
          },
          {
            id: 'search',
            user: true,
            trigger: '3',
          },
          {
            id: '3',
            component: <RequestComp/>,
            waitAction: true,
            trigger: '1',
          },
        ]}
      />
    )
}

export default ChatBotCom;

if (document.getElementById('chatbot')) {
    ReactDOM.render(<ChatBotCom />, document.getElementById('chatbot'));
}
