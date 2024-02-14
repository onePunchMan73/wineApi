import { GetStaticPaths, GetStaticProps } from "next";
import { dehydrate, QueryClient } from "react-query";

import {
  PageList,
  getWines,
  getWinesPath,
} from "../../../components/wine/PageList";
import { PagedCollection } from "../../../types/collection";
import { Wine } from "../../../types/Wine";
import { fetch, getCollectionPaths } from "../../../utils/dataAccess";

export const getStaticProps: GetStaticProps = async ({
  params: { page } = {},
}) => {
  const queryClient = new QueryClient();
  await queryClient.prefetchQuery(getWinesPath(page), getWines(page));

  return {
    props: {
      dehydratedState: dehydrate(queryClient),
    },
    revalidate: 1,
  };
};

export const getStaticPaths: GetStaticPaths = async () => {
  const response = await fetch<PagedCollection<Wine>>("/wines");
  const paths = await getCollectionPaths(
    response,
    "wines",
    "/wines/page/[page]"
  );

  return {
    paths,
    fallback: true,
  };
};

export default PageList;
