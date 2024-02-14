import {
  GetStaticPaths,
  GetStaticProps,
  NextComponentType,
  NextPageContext,
} from "next";
import DefaultErrorPage from "next/error";
import Head from "next/head";
import { useRouter } from "next/router";
import { dehydrate, QueryClient, useQuery } from "react-query";

import { Show } from "../../../components/wine/Show";
import { PagedCollection } from "../../../types/collection";
import { Wine } from "../../../types/Wine";
import { fetch, FetchResponse, getItemPaths } from "../../../utils/dataAccess";
import { useMercure } from "../../../utils/mercure";

const getWine = async (id: string | string[] | undefined) =>
  id ? await fetch<Wine>(`/wines/${id}`) : Promise.resolve(undefined);

const Page: NextComponentType<NextPageContext> = () => {
  const router = useRouter();
  const { id } = router.query;

  const { data: { data: wine, hubURL, text } = { hubURL: null, text: "" } } =
    useQuery<FetchResponse<Wine> | undefined>(["wine", id], () => getWine(id));
  const wineData = useMercure(wine, hubURL);

  if (!wineData) {
    return <DefaultErrorPage statusCode={404} />;
  }

  return (
    <div>
      <div>
        <Head>
          <title>{`Show Wine ${wineData["@id"]}`}</title>
        </Head>
      </div>
      <Show wine={wineData} text={text} />
    </div>
  );
};

export const getStaticProps: GetStaticProps = async ({
  params: { id } = {},
}) => {
  if (!id) throw new Error("id not in query param");
  const queryClient = new QueryClient();
  await queryClient.prefetchQuery(["wine", id], () => getWine(id));

  return {
    props: {
      dehydratedState: dehydrate(queryClient),
    },
    revalidate: 1,
  };
};

export const getStaticPaths: GetStaticPaths = async () => {
  const response = await fetch<PagedCollection<Wine>>("/wines");
  const paths = await getItemPaths(response, "wines", "/wines/[id]");

  return {
    paths,
    fallback: true,
  };
};

export default Page;
