import { FunctionComponent, useState } from "react";
import Link from "next/link";
import { useRouter } from "next/router";
import { ErrorMessage, Formik } from "formik";
import { useMutation } from "react-query";

import { fetch, FetchError, FetchResponse } from "../../utils/dataAccess";
import { Wine } from "../../types/Wine";

interface Props {
  wine?: Wine;
}

interface SaveParams {
  values: Wine;
}

interface DeleteParams {
  id: string;
}

const saveWine = async ({ values }: SaveParams) =>
  await fetch<Wine>(!values["@id"] ? "/wines" : values["@id"], {
    method: !values["@id"] ? "POST" : "PUT",
    body: JSON.stringify(values),
  });

const deleteWine = async (id: string) =>
  await fetch<Wine>(id, { method: "DELETE" });

export const Form: FunctionComponent<Props> = ({ wine }) => {
  const [, setError] = useState<string | null>(null);
  const router = useRouter();

  const saveMutation = useMutation<
    FetchResponse<Wine> | undefined,
    Error | FetchError,
    SaveParams
  >((saveParams) => saveWine(saveParams));

  const deleteMutation = useMutation<
    FetchResponse<Wine> | undefined,
    Error | FetchError,
    DeleteParams
  >(({ id }) => deleteWine(id), {
    onSuccess: () => {
      router.push("/wines");
    },
    onError: (error) => {
      setError(`Error when deleting the resource: ${error}`);
      console.error(error);
    },
  });

  const handleDelete = () => {
    if (!wine || !wine["@id"]) return;
    if (!window.confirm("Are you sure you want to delete this item?")) return;
    deleteMutation.mutate({ id: wine["@id"] });
  };

  return (
    <div className="container mx-auto px-4 max-w-2xl mt-4">
      <Link
        href="/wines"
        className="text-sm text-cyan-500 font-bold hover:text-cyan-700"
      >
        {`< Back to list`}
      </Link>
      <h1 className="text-3xl my-2">
        {wine ? `Edit Wine ${wine["@id"]}` : `Create Wine`}
      </h1>
      <Formik
        initialValues={
          wine
            ? {
                ...wine,
              }
            : new Wine()
        }
        validate={() => {
          const errors = {};
          // add your validation logic here
          return errors;
        }}
        onSubmit={(values, { setSubmitting, setStatus, setErrors }) => {
          const isCreation = !values["@id"];
          saveMutation.mutate(
            { values },
            {
              onSuccess: () => {
                setStatus({
                  isValid: true,
                  msg: `Element ${isCreation ? "created" : "updated"}.`,
                });
                router.push("/wines");
              },
              onError: (error) => {
                setStatus({
                  isValid: false,
                  msg: `${error.message}`,
                });
                if ("fields" in error) {
                  setErrors(error.fields);
                }
              },
              onSettled: () => {
                setSubmitting(false);
              },
            }
          );
        }}
      >
        {({
          values,
          status,
          errors,
          touched,
          handleChange,
          handleBlur,
          handleSubmit,
          isSubmitting,
        }) => (
          <form className="shadow-md p-4" onSubmit={handleSubmit}>
            <div className="mb-2">
              <label
                className="text-gray-700 block text-sm font-bold"
                htmlFor="wine_name"
              >
                name
              </label>
              <input
                name="name"
                id="wine_name"
                value={values.name ?? ""}
                type="text"
                placeholder=""
                className={`mt-1 block w-full ${
                  errors.name && touched.name ? "border-red-500" : ""
                }`}
                aria-invalid={errors.name && touched.name ? "true" : undefined}
                onChange={handleChange}
                onBlur={handleBlur}
              />
              <ErrorMessage
                className="text-xs text-red-500 pt-1"
                component="div"
                name="name"
              />
            </div>
            <div className="mb-2">
              <label
                className="text-gray-700 block text-sm font-bold"
                htmlFor="wine_description"
              >
                description
              </label>
              <input
                name="description"
                id="wine_description"
                value={values.description ?? ""}
                type="text"
                placeholder=""
                className={`mt-1 block w-full ${
                  errors.description && touched.description
                    ? "border-red-500"
                    : ""
                }`}
                aria-invalid={
                  errors.description && touched.description ? "true" : undefined
                }
                onChange={handleChange}
                onBlur={handleBlur}
              />
              <ErrorMessage
                className="text-xs text-red-500 pt-1"
                component="div"
                name="description"
              />
            </div>
            <div className="mb-2">
              <label
                className="text-gray-700 block text-sm font-bold"
                htmlFor="wine_createdAt"
              >
                createdAt
              </label>
              <input
                name="createdAt"
                id="wine_createdAt"
                value={values.createdAt?.toLocaleString() ?? ""}
                type="dateTime"
                placeholder=""
                className={`mt-1 block w-full ${
                  errors.createdAt && touched.createdAt ? "border-red-500" : ""
                }`}
                aria-invalid={
                  errors.createdAt && touched.createdAt ? "true" : undefined
                }
                onChange={handleChange}
                onBlur={handleBlur}
              />
              <ErrorMessage
                className="text-xs text-red-500 pt-1"
                component="div"
                name="createdAt"
              />
            </div>
            <div className="mb-2">
              <label
                className="text-gray-700 block text-sm font-bold"
                htmlFor="wine_updatedAt"
              >
                updatedAt
              </label>
              <input
                name="updatedAt"
                id="wine_updatedAt"
                value={values.updatedAt?.toLocaleString() ?? ""}
                type="dateTime"
                placeholder=""
                className={`mt-1 block w-full ${
                  errors.updatedAt && touched.updatedAt ? "border-red-500" : ""
                }`}
                aria-invalid={
                  errors.updatedAt && touched.updatedAt ? "true" : undefined
                }
                onChange={handleChange}
                onBlur={handleBlur}
              />
              <ErrorMessage
                className="text-xs text-red-500 pt-1"
                component="div"
                name="updatedAt"
              />
            </div>
            <div className="mb-2">
              <label
                className="text-gray-700 block text-sm font-bold"
                htmlFor="wine_isActive"
              >
                isActive
              </label>
              <input
                name="isActive"
                id="wine_isActive"
                value={values.isActive ?? ""}
                type="checkbox"
                placeholder=""
                className={`mt-1 block w-full ${
                  errors.isActive && touched.isActive ? "border-red-500" : ""
                }`}
                aria-invalid={
                  errors.isActive && touched.isActive ? "true" : undefined
                }
                onChange={handleChange}
                onBlur={handleBlur}
              />
              <ErrorMessage
                className="text-xs text-red-500 pt-1"
                component="div"
                name="isActive"
              />
            </div>
            <div className="mb-2">
              <label
                className="text-gray-700 block text-sm font-bold"
                htmlFor="wine_active"
              >
                active
              </label>
              <input
                name="active"
                id="wine_active"
                value={values.active ?? ""}
                type="checkbox"
                placeholder=""
                className={`mt-1 block w-full ${
                  errors.active && touched.active ? "border-red-500" : ""
                }`}
                aria-invalid={
                  errors.active && touched.active ? "true" : undefined
                }
                onChange={handleChange}
                onBlur={handleBlur}
              />
              <ErrorMessage
                className="text-xs text-red-500 pt-1"
                component="div"
                name="active"
              />
            </div>
            {status && status.msg && (
              <div
                className={`border px-4 py-3 my-4 rounded ${
                  status.isValid
                    ? "text-cyan-700 border-cyan-500 bg-cyan-200/50"
                    : "text-red-700 border-red-400 bg-red-100"
                }`}
                role="alert"
              >
                {status.msg}
              </div>
            )}
            <button
              type="submit"
              className="inline-block mt-2 bg-cyan-500 hover:bg-cyan-700 text-sm text-white font-bold py-2 px-4 rounded"
              disabled={isSubmitting}
            >
              Submit
            </button>
          </form>
        )}
      </Formik>
      <div className="flex space-x-2 mt-4 justify-end">
        {wine && (
          <button
            className="inline-block mt-2 border-2 border-red-400 hover:border-red-700 hover:text-red-700 text-sm text-red-400 font-bold py-2 px-4 rounded"
            onClick={handleDelete}
          >
            Delete
          </button>
        )}
      </div>
    </div>
  );
};
