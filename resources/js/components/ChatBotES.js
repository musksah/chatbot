import React from 'react';
import ReactDOM from 'react-dom';
import ChatBot from 'react-simple-chatbot';

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

function ChatBotComEs() {
    return (
        <ChatBot
        steps={[
          {
            id: '1',
            message: 'Hola, Cómo puedo ayudarte?',
            trigger: '2',
          },
          {
            id: '2',
            user: true,
            validator: (value) => {
              if (isNaN(value)) {
                return 'El valor debe ser un nombre';
              }
              return true;
            },
            trigger: '1',
          },
        ]}
      />
    )
}

export default ChatBotComEs;

if (document.getElementById('chatbotes')) {
    ReactDOM.render(<ChatBotComEs />, document.getElementById('chatbotes'));
}
