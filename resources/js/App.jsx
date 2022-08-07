import React from "react";
import Card from "./components/Card";
import Navbar from "./components/Navabar";

export default function Index() {
  let nameList = ["Joko", "Fajar", "Licun"];

  let cardList = nameList.map((name) => {
    return <Card name={name} />;
  })

  return (
    <div>
      <Navbar />

      {cardList}
    </div>
  );
}