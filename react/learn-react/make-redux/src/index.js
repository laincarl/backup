// let appState = {
//     title: {
//         text: 'React.js小书',
//         color: 'red'
//     },
//     content: {
//         text: 'React.js 小书内容',
//         color: 'blue'
//     }
// }
function renderApp(newState, oldState = {}) {
    if (newState === oldState) {
        return;
    }
    console.log("render app");
    renderTitle(newState.title, oldState.title);
    renderContent(newState.content, oldState.content);
}
function renderTitle(newtitle, oldtitle = {}) {
    if (newtitle === oldtitle) {
        return;
    }
    console.log("render title");
    var titleDom = document.getElementById("title");
    titleDom.innerHTML = newtitle.text;
    titleDom.style.color = newtitle.color;
}
function renderContent(newcontent, oldcontent = {}) {
    if (newcontent === oldcontent) {
        return;
    }
    console.log("render content");
    var titleDom = document.getElementById("content");
    titleDom.innerHTML = newcontent.text;
    titleDom.style.color = newcontent.color;
}
function reducer(state, action) {
    if (!state) {
        return {
            title: {
                text: 'React.js小书',
                color: 'red'
            },
            content: {
                text: 'React.js 小书内容',
                color: 'blue'
            }
        }
    }

    switch (action.type) {
    case "UPDATE_TITLE_TEXT":
        return {
            ...state,
            title: {
                ...state.title,
                text: action.text
            }
        }
    case "UPDATE_TITLE_COLOR":
        return {
            ...state,
            title: {
                ...state.title,
                color: action.color
            }
        }

    default:
        return state;
    }
}
// dispatch({
//     type: "UPDATE_TITLE_TEXT",
//     text: "dispatch标题修改"
// });

function createStore(reducer) {
    let state = null;
    const listeners = [];
    const subscribe = (listener) => listeners.push(listener);
    const getState = () => state;
    const dispatch = (action) => {
        state = reducer(state, action);
        listeners.forEach((listener) => listener());
    };
    dispatch({}) // 初始化 state
    return {
        getState,
        dispatch,
        subscribe
    };
}
var store = createStore(reducer);
let oldState = store.getState();
store.subscribe(() => {
    var newState = store.getState();
    renderApp(newState, oldState);
    oldState = newState;
});
renderApp(store.getState())
store.dispatch({
    type: "UPDATE_TITLE_TEXT",
    text: "store标题修改"
});
store.dispatch({
    type: "UPDATE_TITLE_COLOR",
    color: "green"
});
