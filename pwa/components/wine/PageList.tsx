import { NextComponentType, NextPageContext } from "next";
import { useRouter } from "next/router";
import Head from "next/head";
import { useQuery } from "react-query";

import Pagination from "../common/Pagination";
import { List } from "./List";
import { PagedCollection } from "../../types/collection";
import { Wine } from "../../types/Wine";
import { fetch, FetchResponse, parsePage } from "../../utils/dataAccess";
import { useMercure } from "../../utils/mercure";

export const getWinesPath = (page?: string | string[] | undefined) =>
  `/wines${typeof page === "string" ? `?page=${page}` : ""}`;
export const getWines = (page?: string | string[] | undefined) => async () =>
  await fetch<PagedCollection<Wine>>(getWinesPath(page));
const getPagePath = (path: string) => `/wines/page/${parsePage("wines", path)}`;

export const PageList: NextComponentType<NextPageContext> = () => {
  const {
    query: { page },
  } = useRouter();
  const { data: { data: wines, hubURL } = { hubURL: null } } = useQuery<
    FetchResponse<PagedCollection<Wine>> | undefined
  >(getWinesPath(page), getWines(page));
  const collection = useMercure(wines, hubURL);

  if (!collection || !collection["hydra:member"]) return null;

  return (
    <div>
      <div>
        <Head>
          <title>Wine List</title>
        </Head>
      </div>
      <List wines={collection["hydra:member"]} />
      <Pagination collection={collection} getPagePath={getPagePath} />
    </div>
  );
};
