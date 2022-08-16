import React from "react";
import { createRoot } from "react-dom/client";
import Card from "./components/Card";
import Navbar from "./components/Navabar";

function Index() {
  let nameList = ["Joko", "Fajar", "Licun"];

  let cardList = nameList.map((name) => {
    return <Card name={name} key={name} />;
  })

  return (
    <div>
      <Navbar />

      {cardList}
    </div>
  );
}

createRoot(document.getElementById("app")).render(<Index />)