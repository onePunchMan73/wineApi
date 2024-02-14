import { NextComponentType, NextPageContext } from "next";
import Head from "next/head";

import { Form } from "../../components/wine/Form";

const Page: NextComponentType<NextPageContext> = () => (
  <div>
    <div>
      <Head>
        <title>Create Wine</title>
      </Head>
    </div>
    <Form />
  </div>
);

export default Page;
