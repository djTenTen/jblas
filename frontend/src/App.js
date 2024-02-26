
import {BrowserRouter, Routes, Route} from 'react-router-dom';

import Login from './components/index/login';

function App() {
    return (
        <div>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Login />}> </Route>
                    <Route path="/login" element={<Login />}> </Route>
                </Routes>
            </BrowserRouter>
        </div>
    );
}

export default App;
