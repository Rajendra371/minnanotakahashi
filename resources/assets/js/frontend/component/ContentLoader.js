import React from "react";
import ContentLoader from "react-content-loader";

const MyLoader = (props) => (
  <ContentLoader
    speed={2}
    width={1100}
    height={550}
    viewBox="0 0 800 400"
    backgroundColor="#f3f3f3"
    foregroundColor="#cecece"
    {...props}
  >
    <rect x="472" y="154" rx="5" ry="5" width="300" height="10" />
    <rect x="472" y="184" rx="5" ry="5" width="300" height="10" />
    <rect x="472" y="214" rx="5" ry="5" width="300" height="10" />
    <rect x="472" y="244" rx="5" ry="5" width="300" height="10" />
    <rect x="64" y="0" rx="0" ry="0" width="346" height="300" />
    <rect x="10" y="0" rx="0" ry="0" width="40" height="44" />
    <rect x="10" y="60" rx="0" ry="0" width="40" height="44" />
    <rect x="10" y="120" rx="0" ry="0" width="40" height="44" />
    <rect x="10" y="180" rx="0" ry="0" width="40" height="44" />
    <rect x="470" y="0" rx="0" ry="0" width="300" height="25" />
    <rect x="470" y="58" rx="0" ry="0" width="300" height="6" />
    <rect x="470" y="68" rx="0" ry="0" width="300" height="6" />
    <rect x="470" y="78" rx="0" ry="0" width="300" height="6" />
    <rect x="470" y="99" rx="0" ry="0" width="70" height="30" />
    <rect x="560" y="99" rx="0" ry="0" width="70" height="30" />
  </ContentLoader>
);

export default MyLoader;
